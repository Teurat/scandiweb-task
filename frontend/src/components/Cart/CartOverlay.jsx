import { useCart } from '../../context/CartContext';
import CartItem from './CartItem';
import formatPrice from '../../utils/formatPrice';
import { useMutation } from '@apollo/client';
import { PLACE_ORDER } from '../../graphql/mutations';
import { toast } from 'react-toastify';

export default function CartOverlay({ onClose }) {
  const { cart, dispatch } = useCart();
  const [placeOrder] = useMutation(PLACE_ORDER);

  const total = cart.reduce(
    (sum, item) => sum + item.qty * item.prices[0].amount,
    0
  );

  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);

  const handleOrder = async () => {
    if (!cart.length) return;
    try {
      const res = await placeOrder({
        variables: {
          items: cart.map(({ id, qty }) => ({
            sku: id,
            qty,
          })),
        },
      });

      console.log('Order response:', res);

      dispatch({ type: 'CLEAR' });
      onClose();
      toast.success('Order placed successfully 🎉');
    } catch (err) {
      console.error('Order failed:', err);
      toast.error('Something went wrong while placing your order ❌');
    }
  };

  return (
    <>
      {import.meta.env.MODE !== 'test' && (
        <div
          onClick={onClose}
          className="fixed left-0 right-0 top-20 bottom-0 bg-black/40 z-40"
        />
      )}

      <aside
        data-testid="cart-overlay"
        className="fixed right-10 top-14 max-h-screen w-96 max-w-full bg-white shadow-lg p-6 z-50 flex flex-col"
      >
        <p className="mb-4 text-lg font-semibold">
          <b>My Bag,</b> {totalItems} {totalItems === 1 ? 'item' : 'items'}
        </p>

        <div className="flex-1 min-h-0 overflow-y-auto pr-2 space-y-4 pb-24">
          {cart.map((item) => (
            <div key={item.key} className="p-3 rounded-md bg-white">
              <CartItem item={item} />
            </div>
          ))}
        </div>

        <div className="sticky bottom-0 bg-white pt-6 pb-4 border-t">
          <div className="flex justify-between text-sm font-bold mb-3">
            <span>Total</span>
            <span data-testid="cart-total" className="italic">
              {formatPrice(total)}
            </span>
          </div>

          <button
            onClick={handleOrder}
            disabled={!cart.length}
            className={`w-full py-3 uppercase text-white text-sm font-semibold tracking-wide ${cart.length
                ? 'bg-[#5ECE7B] hover:bg-[#4BBF6F]'
                : 'bg-gray-400 cursor-not-allowed'
              }`}
          >
            Place Order
          </button>
        </div>

      </aside>
    </>
  );
}
