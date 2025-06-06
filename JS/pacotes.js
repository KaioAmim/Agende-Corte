import React from 'react';

function Pacotes({ adicionarAoCarrinho }) {
  const pacotes = [
    { id: 1, nome: 'Plano Básico', categoria: 'Internet', preco: 100 },
    { id: 2, nome: 'Plano Avançado', categoria: 'Internet + TV', preco: 150 },
    { id: 3, nome: 'Plano Premium', categoria: 'Internet + TV + Fone', preco: 200 },
  ];

  return (
    <div>
      <h2>Pacotes Disponíveis</h2>
      <ul>
        {pacotes.map((pacote) => (
          <li key={pacote.id}>
            <div>{pacote.nome}</div>
            <div>Categoria: {pacote.categoria}</div>
            <div>Preço: R$ {pacote.preco}</div>
            <button onClick={() => adicionarAoCarrinho(pacote)}>Selecionar Plano</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Pacotes;