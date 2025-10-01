import { useReducer, useEffect, useState } from 'react';
import { CartContext } from './CartContext';
import { reducer, initial } from '../utils/cartUtils';

export function CartProvider({ children }) {
  const [cart, dispatch] = useReducer(reducer, initial);
  const [open, setOpen] = useState(false);

  useEffect(() => {
    localStorage.setItem('cart', JSON.stringify(cart));
  }, [cart]);

  return (
    <CartContext.Provider value={{ cart, dispatch, open, setOpen }}>
      {children}
    </CartContext.Provider>
  );
}
