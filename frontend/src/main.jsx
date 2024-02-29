import React from 'react';
import ReactDOM from 'react-dom/client';
import { RouterProvider, createBrowserRouter } from 'react-router-dom';
import { ProfileProductProvider } from './contexts/profileProductContext.jsx';
import App from './App.jsx';
import Home from './pages/Home/Home.jsx';
import Others from './pages/Others/Others.jsx';
import Login from './pages/Login/Login.jsx';
import Cart from './pages/Cart/Cart.jsx';
import CreateAccount from './pages/CreateAccount/CreateAccount.jsx';
import { UserProvider } from './contexts/userContext.jsx';
import Profile from './pages/Profile/Profile.jsx';

const router = createBrowserRouter([
  {
    element: <App />,
    children: [
      {
        path: "/",
        element: <Home />,
      },
      {
        path: "/pages",
        element: <Others />,
      },
      {
        path: "/customer/account/create",
        element: <CreateAccount />
      },
      {
        path: "/customer/account/login",
        element: <Login />,
      },
      {
        path: "/customer/account",
        element: <Profile />,
      },
      {
        path: "/checkout/cart",
        element: <Cart />,
      },
    ],
  },
]);

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <ProfileProductProvider>
      <UserProvider>
        <RouterProvider router={router} />
      </UserProvider>
    </ProfileProductProvider>
  </React.StrictMode>,
)
