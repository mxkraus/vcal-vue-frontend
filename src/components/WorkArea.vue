<template>

    <div class="work-area">

        <h1 class="wa-title">{{ position.title.rendered }}</h1>

        <div class="wa-content">
            <pp-workshift
                v-for="(n,index) in 2 " :key="index"
                v-bind:waindex="index + 1"
            >  
             
            </pp-workshift>
        </div>

    </div>

</template>

<script>

    import WorkShift from './WorkShift';

    export default{

        name: 'WorkArea',

        props: ['position', 'waFlexWidth'], // recieving a prop

        components: {
            'pp-workshift': WorkShift,
        },

        data(){
            return{

            }
        }

    }

</script>

<style lang="scss">

    .work-area{
        // height: 100vh;
        box-shadow: 3px 3px 10px black;
        background-color: white;
        .wa-title{
            background-color: #dae7da;
            width: 100%;
            padding: 10px;
            color: #333;
        }
        .wa-content{
            display: flex;
            flex-flow: column;
            // height: 100%;
        }
    }

</style>
