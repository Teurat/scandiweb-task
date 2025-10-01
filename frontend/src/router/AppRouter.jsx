import { Routes, Route, Navigate } from 'react-router-dom';
import CategoryPage from '../pages/CategoryPage';
import ProductPage from '../pages/ProductPage';

export default function AppRouter() {
  return (
    <Routes>
      <Route path="/" element={<Navigate to="/all" />} />
      <Route path="/:name" element={<CategoryPage />} />

      <Route path="/product/:id" element={<ProductPage />} />
      <Route path="/notfound" element={<p>Not Found</p>} />
    </Routes>
  );
}
