export const initial = JSON.parse(localStorage.getItem('cart') || '[]');

export function reducer(state, { type, payload }) {
  switch (type) {
    case 'ADD': {
      const idx = state.findIndex(i => i.key === payload.key);
      if (idx > -1) {
        const copy = [...state];
        copy[idx].qty += 1;
        return copy;
      }
      return [...state, { ...payload, qty: 1 }];
    }
    case 'INC':
      return state.map(i => i.key === payload ? { ...i, qty: i.qty + 1 } : i);
    case 'DEC':
      return state
        .map(i => i.key === payload ? { ...i, qty: i.qty - 1 } : i)
        .filter(i => i.qty > 0);
    case 'CLEAR':
      return [];
    default:
      return state;
  }
}
