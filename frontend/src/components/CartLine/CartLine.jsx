import { useContext } from 'react';
import './CartLine.scss';
import { ProfileProductContext } from '../../contexts/profileProductContext';

function CartLine() {
    const { profileProduct } = useContext(ProfileProductContext);

    return (
        <>
            <td className='profileProduct__card'>
                <span>
                    <img className='profileProduct__img' src={profileProduct[0].image} />
                </span>
                <span className='profileProduct__card--content'>
                    <p className='profileProduct__title'>{profileProduct[0].title}</p>
                    <p className='profileProduct__author'>{profileProduct[0].author}</p>
                    <p className='profileProduct__price'>{profileProduct[0].price} €</p>
                </span>
            </td>
            <td>
                <span className='profileProduct__quantity'>
                <button>-</button>
                <input defaultValue='0' />
                <button>+</button>
                </span>
            </td>
            <td className='profileProduct__total'>
                <p className='profileProduct__total--price'>{profileProduct[0].price} €</p>
            </td>
        </>
    );
}

export default CartLine;