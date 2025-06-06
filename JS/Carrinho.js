document.addEventListener("DOMContentLoaded", () => {
  const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

  document.querySelectorAll(".add-to-cart").forEach(button => {
      button.addEventListener("click", function() {
          const packageElement = this.closest(".package");
          const id = parseInt(packageElement.getAttribute("data-id"));
          const name = packageElement.getAttribute("data-name");
          const price = parseFloat(packageElement.getAttribute("data-price"));
          const image = packageElement.getAttribute("data-image"); // Captura a URL da imagem

          const existingItem = cartItems.find(item => item.id === id);
          if (existingItem) {
              existingItem.quantity += 1;
          } else {
            cartItems.push({ id, name, price, quantity: 1, image }); // Armazena a imagem
        }

          // Salva os itens no localStorage
          localStorage.setItem('cartItems', JSON.stringify(cartItems));

          // Redireciona para a página do carrinho
          window.location.href = 'Carrinho.php';
      });
  });
});