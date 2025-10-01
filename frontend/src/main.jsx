import React from 'react';
import ReactDOM from 'react-dom/client';

import { BrowserRouter } from 'react-router-dom';
import { ApolloProvider } from '@apollo/client';
import { client } from './apollo/client';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

import { CartProvider } from './context/CartProvider';
import App from './App';
import './index.css';

ReactDOM.createRoot(document.getElementById('root')).render(
    <ApolloProvider client={client}>
      <BrowserRouter basename="/">
        <CartProvider>
          <ToastContainer position="top-right" autoClose={5000} hideProgressBar />
          <App />      
        </CartProvider>
      </BrowserRouter>
    </ApolloProvider>
);
