<template>
  <div class="container">
    <div>
      <h2>Ativo Agora</h2>
    </div>

    <div>
      <h3>Por enquanto está quieto...</h3>
      <p>Quando um amigo começar um papo contigo vai aparecer aqui</p>
    </div>
  </div>
</template>

<script>
</script>

<style scoped lang="scss">
.container {
  grid-area: AU;
  display: flex;
  flex-direction: column;
  background-color: var(--secondary);
  padding: 3px 6px 10px 16px;
  max-height: calc(100vh - 46px);
  div:nth-child(1) {
    h2 {
      color: var(--white);
      font-weight: bold;
      padding-top: 15px;
    }
  }
  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    padding: 10px;
    h3 {
      color: var(--white);
      font-weight: bold;
      font-size: 22px;
    }
    p {
      color: var(--symbol);
    }
  }
}
</style>