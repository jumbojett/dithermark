<template>
    <div>
        <button class="cycle-property-list-button btn btn-default btn-xs" :title="previousButtonTitle" @click="previousButtonClicked">&lt;</button>
        <button class="cycle-property-list-button btn btn-default btn-xs" :title="nextButtonTitle" @click="nextButtonClicked">&gt;</button>
    </div>
</template>

<script>
export default {
    name: 'cycle-property-list', 
    props: {
        value: {
            type: Number, 
            // required: true //when app first starts, will be null for some values
        },
        modelName: {
            type: String, 
            required: true
        },
        arrayLength: {
            type: Number, 
            required: true
        },
        arrayStartIndex: {
            type: Number,
            default: 0,
        },
    },
    computed: {
        previousButtonTitle(){
            return `Previous ${this.modelName}`;
        },
        nextButtonTitle(){
            return `Next ${this.modelName}`;
        },
    },
    methods: {
        previousButtonClicked(){
            let newValue = this.value - 1;
            if(newValue < this.arrayStartIndex){
                newValue = this.arrayLength - 1;
            }
            this.$emit('input', newValue);
        },
        nextButtonClicked(){
            let newValue = this.value + 1;
            if(newValue >= this.arrayLength){
                newValue = this.arrayStartIndex;
            }
            this.$emit('input', newValue);
        },
    },
};
</script>