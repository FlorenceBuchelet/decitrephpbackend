import ProductCard from "../../components/ProductCard/ProductCard";
import "../Home/Home.scss";
import "./Others.scss";
import ProductProfile from "../../components/ProductProfile/ProductProfile";
import { useOutletContext } from "react-router-dom";

function Others() {
    const [productsArray] = useOutletContext();

    return (
        <main className="home others">
            <article className="others__productProfifle">
                <ProductProfile/>
            </article>
            <section className="home__bestsellers others__productCards--list">
                <h1>Beaucoup de livres</h1>
                <article className="home__bestsellers--map">
                {productsArray ? productsArray.sort(() => 0.5 - Math.random()).toReversed().slice(0, 5).map((product) => (
                        <ProductCard
                            key={product.product_id}
                            id={product.product_id}
                            ean={product.ean}
                            title={product.title}
                            image={product.image}
                            author={product.author}
                            price={product.price}
                            promo={product.promo_price}
                        />
                    )) : "Loading"}
                </article>
                <button className="home__buttons others__buttons" type="button">Toutes les meilleures ventes</button>
            </section>

        </main>
    );
}

export default Others;