<template>
  <div>
    <div class="principal">
      <div class="sucesso">
        <img src="image/receve.jpg" />
        <p>
          Bem Vindo a Temporary SMS, Por favor verifique a caixa do seu Email
          para ativação da conta
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.principal {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100vh;
  background: linear-gradient(to right, rgb(78, 39, 231), rgb(101, 9, 200));
}
.principal .sucesso {
  text-align: center;
  position: absolute;
  width: 700px;
  padding: 20px;
  background-color: white;
  border-radius: 4px;
}
.sucesso p {
  font-size: 18px;
  text-indent: 13px;
}
.sucesso img {
  width: 140px;
}
</style>