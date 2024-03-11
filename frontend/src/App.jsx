import { Outlet } from 'react-router-dom'
import './App.scss'
import Nav from './components/Nav/Nav'
import SecondaryNav from './components/SecondaryNav/SecondaryNav'
import { useState, useEffect, useContext } from 'react';
// for secret button
import { UserContext } from './contexts/userContext';


function App() {
  const [productsArray, setProductsArray] = useState([]);
  const [notification, setNotification] = useState(0);

  // secret disconnection button
  const { setUser } = useContext(UserContext);
  const handleDisconnect = async () => {
    try {
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/disconnect.php`, {
        credentials: 'include'
      });
      const textResponse = await response.text();
      if (textResponse === "disconnected") {
        setUser([{}]);
        setNotification(0);
      }
    } catch (error) {
      console.error("Error in disconnection: ", error);
    }
  }
  // end of secret button

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
      await fetch(`${import.meta.env.VITE_BACKEND_URL}src/userRoutes/sessionStart.php`, {
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
      <button style={{ color: 'white' }} type='button' onClick={handleDisconnect}>x</button>
      <Outlet
        context={{ productsArray, notification, setNotification }}
      />
    </>
  )
}

export default App;
