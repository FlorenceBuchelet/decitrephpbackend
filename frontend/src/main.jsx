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
import Confirm from './pages/Checkout/Confirmation/Confirm.jsx';
import Delivery from './pages/Checkout/Delivery/Delivery.jsx';
import NewAddress from './pages/Checkout/NewAddress/NewAddress.jsx';
import Identification from './pages/Checkout/Identification/Identification.jsx';
import Payment from './pages/Checkout/Payment/Payment.jsx';

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
      {
        path: "/checkout/identification",
        element: <Identification />,
      },
      {
        path: "/checkout/delivery",
        element: <Delivery />,
      },
      {
        path: "/checkout/newaddress",
        element: <NewAddress />,
      },
      {
        path: "/checkout/confirmation",
        element: <Confirm />,
      },
      {
        path: "/checkout/payment",
        element: <Payment />,
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
