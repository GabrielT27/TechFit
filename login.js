const button = document.getElementById('loginBtn'); //pega o click do butão

button.addEventListener("click", async (e) => { // ao click roda a função de callback 
  e.preventDefault(); // para o evento do formulário

  const usuario = document.getElementById('usuario').value; // pega o valor do usuario
  const senha = document.getElementById('senha').value; // pega o valor da senha 

  // Verificação de usuario e senha 
  console.log(usuario); 
  console.log(senha);

  try { // tenta 
    const res = await fetch('http://localhost:8000/login.php', { // Realiza a busca no servidor, post do objeto 
      method: 'POST', // metodo da busca
      headers: {
        'Content-Type': 'application/json' // cabeçalho
      },
      body: JSON.stringify({ usuario, senha }) // transforma o usuario e senha em json para comunicação com o php
    });

    if (!res.ok) { // se requisição não for ok 
      throw new Error("Erro na requisição: " + res.status); // traz o erro da requisição
    }

    const data = await res.json(); // data, dados da requisição em json 
    console.log(data); // coloca no console os dados

    if (data.status === 'sucesso') {
      alert(`Bem-vindo, ${usuario}! Redirecionando...`);
      window.location.href = `/index?title=${encodeURIComponent(usuario)}`;
    } else {
      alert("Usuário ou senha inválidos. Tente novamente.");
    }

  } catch (erro) {
    console.error("Erro ao conectar ao servidor:", erro);
    alert("Erro ao conectar ao servidor. Verifique se o backend está rodando.");
  }
});
