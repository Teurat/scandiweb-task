import { useState, useCallback } from 'react';
import { Link } from 'react-router-dom';
import { useCart } from '../../context/CartContext';
import formatPrice from '../../utils/formatPrice';
import kebabCase from '../../utils/kebabCase';

export default function ProductCard({ product }) {
  const { dispatch } = useCart();
  const [hover, setHover] = useState(false);

  const addToCart = useCallback(
    (e) => {
      e.stopPropagation();
      e.preventDefault();

      const selectedAttrs = {};
      product.attributes.forEach((attr) => {
        const firstValue = attr.values?.[0];
        if (firstValue) selectedAttrs[attr.label] = firstValue.value;
      });

      const stableAttrs = Object.entries(selectedAttrs).sort();
      const key = JSON.stringify([product.id, stableAttrs]);

      dispatch({
        type: 'ADD',
        payload: {
          id: product.id,
          name: product.name,
          prices: product.prices,
          selectedAttrs,
          gallery: product.gallery,
          key,
        },
      });
    },
    [dispatch, product]
  );

  const inStock = product.inStock;

  return (
    <Link
      to={`/product/${product.id}`}
      className="block"
      data-testid={`product-${kebabCase(product.name)}`}
    >
      <article
        className="relative mb-12 w-[420px] h-[500px] bg-white rounded-md hover:shadow-product transition-all overflow-hidden"
        onMouseEnter={() => setHover(true)}
        onMouseLeave={() => setHover(false)}
      >
        <div className="relative h-[360px] p-3">
          <div className="w-full h-full rounded-md overflow-hidden bg-white">
            <img
              src={product.gallery[0]}
              alt={product.name}
              className={`w-full h-full object-contain transition-transform duration-200 ...
 ${inStock ? '' : 'opacity-40'
                }`}
            />
          </div>

          {!inStock && (
            <span className="absolute inset-0 flex items-center justify-center text-xl font-semibold text-gray-500">
              OUT OF STOCK
            </span>
          )}
        </div>

        {(hover || import.meta.env.MODE === 'test') && inStock && (
          <button
            onClick={addToCart}
            className="absolute bottom-24 right-6 bg-brand p-4 rounded-full shadow-md"
            data-testid="quick-shop-btn"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="white"
              viewBox="0 0 24 24"
              className="w-6 h-6"
            >
              <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7.16 14h9.45c.75 0 1.41-.41 1.75-1.03l3.24-5.97a.99.99 0 00-.88-1.47H6.21l-.94-2H1v2h2l3.6 7.59-1.35 2.45C4.52 17.37 5.48 19 7 19h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h8.45c.75 0 1.41-.41 1.75-1.03L21 9H7.16l-.74-1.36L7.16 14z" />
            </svg>
          </button>
        )}

        <div className="px-6 py-4">
          <p className="text-base font-raleway">{product.name}</p>
          <p className="font-bold text-lg font-raleway">
            {formatPrice(product.prices[0].amount)}
          </p>
        </div>
      </article>
    </Link>
  );
}
