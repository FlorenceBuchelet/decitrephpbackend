import './CartLine.scss';
import handleOrder from "../../services/handleOrder";
import handleUnorder from "../../services/handleUnorder";
import { useEffect, useState } from 'react';


function CartLine({ productId, image, title, author, price, promoPrice, quantity, setTotalPrice, totalPrice }) {
    const [lineQuantity, setLineQuantity] = useState(quantity);

const handlePlus = () => {
    handleOrder(productId);
    setLineQuantity(lineQuantity +1);
};

const handleMinus = () => {
    handleUnorder(productId);
    setLineQuantity(lineQuantity - 1);
};

    return (
        <tr>
            <td className='profileProduct__card'>
                <span>
                    <img className='profileProduct__img' src={image ? image : ""} />
                </span>
                <span className='profileProduct__card--content'>
                    <p className='profileProduct__title'>{title ? title : ""}</p>
                    <p className='profileProduct__author'>{author ? author : ""}</p>
                </span>
            </td>
            <td>
                <span className='profileProduct__quantity'>
                    <button onClick={handleMinus}>-</button>
                    <input value={lineQuantity} onChange={() => {}} />
                    <button onClick={handlePlus}>+</button>
                </span>
            </td>
            <td className='profileProduct__total'>
                {promoPrice ?
                    <>
                        <p className='profileProduct__prices profileProduct__prices--old'><s>{`${price * lineQuantity} €`}</s></p>
                        <p className='profileProduct__prices profileProduct__prices--promo'>{`${promoPrice * lineQuantity} €`}</p>
                    </>
                    :
                    <p className='profileProduct__prices profileProduct__prices--current'>{price ? `${price * lineQuantity} €` : ""}</p>
                }
            </td>
        </tr>
    );
}

export default CartLine;