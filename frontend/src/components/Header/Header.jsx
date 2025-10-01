import { Link } from 'react-router-dom';
import { useQuery } from '@apollo/client';
import { GET_CATEGORIES } from '../../graphql/queries';
import CategoryLink from './CategoryLink';
import CartOverlay from '../Cart/CartOverlay';
import { useCart } from '../../context/CartContext';
import bagIcon from '../../assets/bag.svg';

export default function Header() {
  const { data } = useQuery(GET_CATEGORIES);
  const { cart, open, setOpen } = useCart();
  const totalQty = cart.reduce((s, i) => s + i.qty, 0);

  return (
    <header className="fixed inset-x-0 top-0 z-50 bg-white shadow">
      <div className="h-20 mx-auto flex items-center justify-between px-8 max-w-screen-xl">

        <nav className="flex gap-8 h-full items-center">
          {data?.categories.map((c) => (
            <CategoryLink key={c.name} name={c.name} />
          ))}
        </nav>

        <Link to="/" aria-label="Home" className="flex items-center h-full mr-[14rem]">
          <img src={bagIcon} alt="logo" className="w-6 h-6" />
        </Link>

        <div className="flex items-center h-full">
          <button
            data-testid="cart-btn"
            onClick={() => setOpen((p) => !p)}
            className="relative flex items-center"
            aria-label="Cart"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              className="w-6 h-6 text-gray-700"
              fill="none"
              stroke="currentColor"
              strokeWidth="1.2"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10m0 0a1 1 0 100 2 1 1 0 000-2zm-10 0a1 1 0 100 2 1 1 0 000-2z"
              />
            </svg>

            {totalQty > 0 && (
              <span className="absolute -top-2 -right-2 w-5 h-5 rounded-full bg-black text-white text-xs flex items-center justify-center">
                {totalQty}
              </span>
            )}
          </button>
        </div>

        {open && <CartOverlay onClose={() => setOpen(false)} />}
      </div>
    </header>
  );
}
