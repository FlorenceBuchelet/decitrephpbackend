const handleOrder = async (productId) => {
    try {
        const formData = new FormData();
        formData.append('productId', productId);
        const response = await fetch('http://decitrephpbackend/src/productRoutes/cart.php', {
            method: "POST",
            credentials: 'include',
            body: formData
        });
        // if response.ok => actualise le panier
    } catch (error) {
        console.error("Error in updating cart: ", error)
    }
};

export default handleOrder;