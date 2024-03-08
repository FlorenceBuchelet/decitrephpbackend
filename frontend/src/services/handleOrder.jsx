const handleOrder = async (productId) => {
    try {
        await fetch(`${import.meta.env.VITE_BACKEND_URL}src/productRoutes/addToCart.php?productId=${productId}&quantity=1`, {
            credentials: 'include',
        });
   //     window.location.reload();
    } catch (error) {
        console.error("Error in updating cart: ", error)
    }
};

export default handleOrder;