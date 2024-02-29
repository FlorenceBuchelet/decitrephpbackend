import './CartLine.scss';

function CartLine({ id, image, title, author, price, promoPrice, quantity}) {

    return (
        <>
            <td className='profileProduct__card'>
                <span>
                    <img className='profileProduct__img' src={image ? image : ""} />
                </span>
                <span className='profileProduct__card--content'>
                    <p className='profileProduct__title'>{title ? title : ""}</p>
                    <p className='profileProduct__author'>{author ? author : ""}</p>
                    <p className='profileProduct__price'>{price ? `${price}€` : ""}</p>
                </span>
            </td>
            <td>
                <span className='profileProduct__quantity'>
                <button>-</button>
                <input defaultValue={quantity ? quantity : ""} />
                <button>+</button>
                </span>
            </td>
            <td className='profileProduct__total'>
                <p className='profileProduct__total--price'>{price ? `${price}€` : ""}</p>
            </td>
        </>
    );
}

export default CartLine;