<template>
<v-main>
    <v-container>
        <h1>Login</h1>
        <v-text-field label="email" type="email"></v-text-field>
        <v-text-field label="passwd" type="password"></v-text-field>
    <v-btn rounded>Login</v-btn>
    </v-container>
</v-main>
</template>
<script>
export default {
  name: 'LoginForm'
}
</script>