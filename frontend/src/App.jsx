import Header from './components/Header/Header';
import AppRouter from './router/AppRouter';

import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export default function App() {
  return (
    <>
      <h1 className="text-4xl font-bold text-red-500">Test Tailwind</h1>
      <Header />
      <main className="pt-24 px-8">
        <AppRouter />
      </main>

      <ToastContainer position="top-right" autoClose={3000} />
    </>
  );
}
