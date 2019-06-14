<template>
    <div
        class="cursor-pointer"
        @click="click"
    >
        <slot>
            <!-- <i class="fa fa-bars"/> -->
            <i class="fa" v-bind:class="[hidden ? 'fa-bars' : 'fa-times']" ></i>
        </slot>
    </div>
</template>

<script>
export default {
    name: 'VueAdsHideButton',

    props: {
        hidden: {
            required: true,
            validator: (value) => {
                return value === null || typeof value === 'boolean';
            },
        },
    },

    methods: {
        click () {
            this.$emit('clicked', !this.hidden, this.activated);
        },
    },
};
</script>

<style scoped>
    i{
        font-size: 20px;
        cursor: pointer;
        margin-right: 30px;
    }
</style>
