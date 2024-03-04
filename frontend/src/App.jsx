import { Outlet } from 'react-router-dom'
import './App.scss'
import Nav from './components/Nav/Nav'
import SecondaryNav from './components/SecondaryNav/SecondaryNav'
import { useState, useEffect } from 'react';

function App() {
  const [productsArray, setProductsArray] = useState([]);

  const fetchProducts = async () => {
    try {
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/getAllProducts.php`);
      const products = await response.json();
      setProductsArray(products);
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };


  useEffect(() => {
    fetchProducts();
  }, []);

  return (
    <>
      <Nav />
      <SecondaryNav />
      <Outlet
        context={[productsArray]}
      />
    </>
  )
}

export default App;
