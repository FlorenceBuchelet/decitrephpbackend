import { Outlet } from 'react-router-dom'
import './App.scss'
import Nav from './components/Nav/Nav'
import SecondaryNav from './components/SecondaryNav/SecondaryNav'
import { useState, useEffect } from 'react';

function App() {
  const [productsArray, setProductsArray] = useState([]);
  const [notification, setNotification] = useState(0);


  const fetchProducts = async () => {
    try {
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getAllProducts.php`);
      const products = await response.json();
      setProductsArray(products);
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };

  const sessionStart = async () => {
    try {
      await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/sessionHandling.php`, {
        credentials: 'include'
      });
    } catch (error) {
      console.error('Error while creating session: ', error)
    }
  };


  useEffect(() => {
    fetchProducts();
    sessionStart();
  }, []);

  return (
    <>
      <Nav
        notification={notification}
        setNotification={setNotification}
      />
      <SecondaryNav />
      <Outlet
        context={{ productsArray, setNotification }}
      />
    </>
  )
}

export default App;
