<template>
</template>

<script>
    export default {
        name: "crude",
        props: ["crude", "productCrudes"],
        watch: {
            // "crude.name": function(newVal, previousVal) {
            //     console.log(this.crude)
            //     console.log("new Value is " + newVal,
            //         "previous value is " + previousVal);
            // },
            "crude.quantity": function(newVal, previousVal) {
                this.productCrudes.push({})
                this.productCrudes.pop()
                // console.log()
                // console.log("new Value is " + newVal,
                //     "previous value is " + previousVal);
            }
        }
    };
</script>
