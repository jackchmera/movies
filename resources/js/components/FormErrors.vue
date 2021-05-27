<template>
    <!--<div v-if="validationErrors" v-show="showErrors">-->
    <div v-show="showErrors">
        <!--<ul class="alert alert-danger">-->
            <!--<li v-for="(value, key, index) in validationErrors">{{ value }}</li>-->
        <!--</ul>-->
    </div>
</template>

<script>
export default {
    name: 'FormErrors',
    props: ['validationErrors', 'showErrors'],
//    props: {
//        'showErrors': Boolean,
//        'validationErrors': Object
//    },
    
    data() {
        return {
//            validationErrors: {},
//            showErrors: true
        }
    },
//    computed: {
//        validationErrors(){
//            let errors = Object.values(this.validationErrors);
//            errors = errors.flat();
//            this.showErrors = (errors != '') ? true : false;
//            return errors;
//        }
//    }
}
</script>
