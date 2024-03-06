import './CartLine.scss';
import handleOrder from "../../services/handleOrder";
import handleUnorder from "../../services/handleUnorder";

function CartLine({ productId, image, title, author, price, promoPrice, quantity }) {

    const handlePlus = () => {
        handleOrder(productId);

    };

    const handleMinus = () => {
        handleUnorder(productId);
    };

    const handleRemoveFromCart = async () => {
        try {
            await fetch(
                `${import.meta.env.VITE_BACKEND_URL}src/productRoutes/removeFromCart.php?productId=${encodeURIComponent(productId)}`, {
                    credentials: 'include'
                }
            );
        } catch (error) {
            console.error("Error in removing item: ", error);
        }
        window.location.reload();
        };

    return (
        <tr>
            <td className='cartLine__card'>
                <span>
                    <img className='cartLine__img' src={image ? image : ""} />
                </span>
                <span className='cartLine__card--content'>
                    <p className='cartLine__title'>{title ? title : ""}</p>
                    <p className='cartLine__author'>{author ? author : ""}</p>
                    {promoPrice ?
                        <>
                            <p className='productCard__prices productCard__prices--old'><s>{`${price.toFixed(2)} €`}</s></p>
                            <p className='productCard__prices productCard__prices--promo'>{`${promoPrice.toFixed(2)} €`}</p>
                        </>
                        :
                        <p className='productCard__prices productCard__prices--current'>{`${price.toFixed(2)} €`}</p>
                    }
                </span>
            </td>
            <td>
                <span className='cartLine__tableData'>
                    <span className='cartLine__quantity'>
                        <button onClick={handleMinus}>-</button>
                        <input defaultValue={quantity} />
                        <button onClick={handlePlus}>+</button>
                    </span>
                    <button type='button' onClick={handleRemoveFromCart}>
                        <img className='cartLine__bin' src={`${import.meta.env.VITE_BACKEND_URL}Public/images/bin.png`} />
                    </button>
                </span>
            </td>
            <td className='cartLine__total'>
                {promoPrice ?
                    <>
                        <p className='cartLine__prices cartLine__prices--old'><s>{`${(price * quantity).toFixed(2)} €`}</s></p>
                        <p className='cartLine__prices cartLine__prices--promo'>{`${(promoPrice * quantity).toFixed(2)} €`}</p>
                    </>
                    :
                    <p className='cartLine__prices cartLine__prices--current'>{`${(price * quantity).toFixed(2)} €`}</p>
                }
            </td>
        </tr>
    );
}

export default CartLine;