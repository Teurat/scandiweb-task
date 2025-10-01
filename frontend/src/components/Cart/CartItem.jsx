import formatPrice from '../../utils/formatPrice';
import kebabCase from '../../utils/kebabCase';
import { useCart } from '../../context/CartContext';

export default function CartItem({ item }) {
  const { dispatch } = useCart();
  const isOutOfStock = item?.inStock === false;

  return (
    <div className="flex items-center gap-6 py-4 border-b p-4">
      <div className="flex-1">
        <p className="text-lg font-semibold mb-2">{item.name}</p>

        {Object.entries(item.selectedAttrs).map(([attr, value]) => {
          const isUndefined = attr === 'undefined';
          const isColor = attr.toLowerCase().includes('color');
          if (typeof value === 'object') return null;

          return (
            <div
              key={attr}
              data-testid={`cart-item-attribute-${kebabCase(attr)}`}
              className="flex justify-between items-center gap-2 text-sm mb-1"
            >
              <span className="text-gray-600">{isUndefined ? 'N/A' : attr}:</span>
              <div
                data-testid={`cart-item-attribute-${kebabCase(attr)}-${kebabCase(value)}`}
                className={`border rounded ${
                  isColor ? 'w-6 h-6 border-gray-300' : 'px-2 py-0.5 bg-gray-100 text-gray-800'
                }`}
                style={isColor ? { backgroundColor: value } : {}}
              >
                {!isColor && value}
              </div>
            </div>
          );
        })}

        <p className="text-base font-bold mt-3 italic">
          {formatPrice(item.prices[0].amount)}
        </p>
      </div>

      <div className="flex items-center gap-3">
        <div className="flex flex-col items-center gap-2">
          <button
            data-testid="cart-item-quantity-increase"
            onClick={() => dispatch({ type: 'INC', payload: item.key })}
            className="w-8 h-8 flex items-center justify-center border border-black text-lg font-light leading-none"
            disabled={isOutOfStock}
            title={isOutOfStock ? 'Out of stock' : ''}
          >
            +
          </button>
          <span data-testid="cart-item-quantity" className="text-base font-medium">
            {item.qty}
          </span>
          <button
            data-testid="cart-item-quantity-decrease"
            onClick={() => dispatch({ type: 'DEC', payload: item.key })}
            className="w-8 h-8 flex items-center justify-center border border-black text-lg font-light leading-none"
            disabled={isOutOfStock}
            title={isOutOfStock ? 'Out of stock' : ''}
          >
            −
          </button>
        </div>

        <img
          src={item.gallery[0]}
          alt={item.name}
          className="w-24 h-24 object-contain rounded shadow-sm"
        />
      </div>
    </div>
  );
}
