<template>

    <div class="work-shift">
        <!-- <span class="ws-label">Schicht {{ waindex }}</span> -->
    </div>
    
</template>

<script>

    export default {

        name: 'WorkShift',

        props: ['waindex'], // recieving a prop

        data(){
            return{
                
            }
        }, 

    }
    
</script>

<style lang="scss">

    .work-shift{
        // flex: 1; 
        border-bottom: 1px solid #b2b2b2;
        padding: 5px;
        position: relative;
        height: 500px;
    }

</style>
