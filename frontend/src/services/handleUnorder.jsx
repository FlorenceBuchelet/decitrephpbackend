const handleUnorder = async (productId) => {
    try {
        await fetch(`http://decitrephpbackend/src/productRoutes/addToCart.php?productId=${productId}`, {
            credentials: 'include',
        });
    } catch (error) {
        console.error("Error in updating cart: ", error)
    }
};

export default handleUnorder;