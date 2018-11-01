<template>
    <div>
        <app-toolbar></app-toolbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>
import Toolbar from './Toolbar'
import Footer from './Footer'
export default {
    components:{
        'appToolbar' : Toolbar,
        'appFooter' : Footer,
    }
}
</script>

<style>

</style>
