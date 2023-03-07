<template>
  <main>
    <div class="content">
      <p>
        Este Link de verificação é inválido por favor tenta um outro link ,
        verique seu email para certificar.
      </p>
    </div>
  </main>
</template>
    
<script>
export default {
  props: {
    erro: String,
  },
};
</script>
    
<style lang="scss" scoped>
main {
  display: flex;
  justify-content: center;
  width: 100%;
  height: 100vh;
  background: linear-gradient(to right, rgb(78, 39, 231), rgb(101, 9, 200));
  .content {
    text-align: center;
    position: absolute;
    margin-top: 20px;
    width: 700px;
    height: auto;
    padding: 10px;
    background-color: white;
    border-radius: 4px;
    border-left: 5px solid red;
    p {
      font-size: 15px;
      text-align: justify;
    }
  }
}
</style>