# PHP initiation

During my first internship as a web developer, I worked for the biggest french online bookseller. In the first five weeks there, I had to learn PHP since I had never tried my hand at it. In order to do that efficiently, I was tasked with creating a clone of their online platform with a front in React and a PHP vanilla backend. The focus was to make both ends communicate seamlessly. 

## Challenges

Platform is an online bookshop so it needed to have:
- A full database including user, product and cart management
- A homepage with bestsellers products
- A search bar with autocomplete based on how often a search is made
- Products profiles
- An authentication page protected with a JWT
- User needs to be able to edit their informations
- User needs to be able to create an account
- User needs to be able to add products to their cart
- User needs to be able to make an order, full cycle
- User needs to be able to add multiple delivery addresses
- User can disconnect from the platform at will
- The cart quantities can be updated in cart and products can be removed from cart
- Total in cart is calculated dynamically
- A notification in the navigation bar displays how many products are in cart

Technically, this means I got to learn PHP through OOP, session handling, API basics, database and cookies handling. I also learnt PHP's syntax and subtilities.

![image](https://github.com/FlorenceBuchelet/decitrephpbackend/assets/144147299/3f58c06f-b171-4d47-b9a3-ee404e504cc4)
![image](https://github.com/FlorenceBuchelet/decitrephpbackend/assets/144147299/f6afc173-5927-418d-b8bc-7809beed5505)

## SETUP

Backend in PHP using WAMP
Frontend in React using Vite (npm run dev in the frontend folder)
Database in SQL using MySQL and PhpMyAdmin (Schema can be found in backend>database>schema_v2)

env.sample are available in back and front.

## React + Vite Template

This template provides a minimal setup to get React working in Vite with HMR and some ESLint rules.

Currently, two official plugins are available:

- [@vitejs/plugin-react](https://github.com/vitejs/vite-plugin-react/blob/main/packages/plugin-react/README.md) uses [Babel](https://babeljs.io/) for Fast Refresh
- [@vitejs/plugin-react-swc](https://github.com/vitejs/vite-plugin-react-swc) uses [SWC](https://swc.rs/) for Fast Refresh
