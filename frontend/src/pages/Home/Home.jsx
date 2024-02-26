import "./Home.scss";
import ProductCard from "../../components/ProductCard/ProductCard";
import { useOutletContext } from "react-router-dom";


function Home() {
    const [productsArray] = useOutletContext();

    return (
        <main className="home">
            <p className="home__welcome breadcrumb">Bienvenue sur decitre.fr : découvrez nos livres, ebooks et produits culturels </p>

            <section className="home__bestsellers">
                <h1>Nos meilleures ventes</h1>
                <article className="home__bestsellers--map">
                    {productsArray ? productsArray.sort(() => 0.5 - Math.random()).slice(0, 5).map((product) => (
                        <ProductCard
                            key={product.product_id}
                            ean={product.ean}
                            title={product.title}
                            image={product.image}
                            author={product.author}
                            price={product.price}
                            promo={product.promo_price}
                        />
                    )) : "Loading"}
                </article>
                <button className="home__buttons" type="button">Toutes les meilleures ventes</button>
            </section>

            <section className="home__news">
                <h2>Les actualités livres du moment</h2>
                <p>Ne manquez pas les livres dont tout le monde parle en ce moment</p>
                <article className="home__news--map">
                    {productsArray ? productsArray.sort(() => 0.5 - Math.random()).toReversed().slice(0, 5).map((product) => (
                        <ProductCard
                            key={product.product_id}
                            ean={product.ean}
                            title={product.title}
                            image={product.image}
                            author={product.author}
                            price={product.price}
                            promo={product.promo_price}
                        />
                    )) : "Loading"}
                </article>
                <button className="home__buttons" type="button">Toutes les sorties du moment</button>
            </section>

            <section className="home__preorder">
                <h2>Précommandes à ne pas manquer</h2>
                <p>Les livres à réserver dès aujourd&apos;hui !</p>
                <article className="home__preorder--map">
                    {productsArray ? productsArray.sort(() => 0.5 - Math.random()).slice(0, 5).map((product) => (
                        <ProductCard
                            key={product.product_id}
                            ean={product.ean}
                            title={product.title}
                            image={product.image}
                            author={product.author}
                            price={product.price}
                            promo={product.promo_price}
                        />
                    )) : "Loading"}
                </article>
                <button className="home__buttons" type="button">Toutes les sorties du moment</button>
            </section>
        </main>
    );
}

export default Home;