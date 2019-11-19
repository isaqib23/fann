<template>
    <div>
        <v-flex>
            <v-combobox
                clearable
                filled
                solo
                v-model="product"
                :items="options"
                :loading="lookingUp"
                :search-input.sync="search"
                :placeholder="placeholder"
                hide-no-data
                hide-selected
                item-text="title"
                item-value="id"
                item-avatar="image.src"
                hide-label
                return-object>
                <template v-slot:selection="data" role="listitem">
                    <v-list-item-avatar>
                        <img v-if="data.item.image != null" :src="data.item.image.src">
                        <v-icon v-else>layers</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content class="productSelection">
                        <v-list-item-title v-html="data.item.title"></v-list-item-title>
                        <v-list-item-subtitle><b>ID :</b> {{data.item.id}}, <b>Variants : </b>{{data.item.variants == undefined ? '' : data.item.variants.length}}</v-list-item-subtitle>
                    </v-list-item-content>
                </template>
                <template v-slot:item="data">
                    <v-list-item-avatar>
                        <img v-if="data.item.image != null" :src="data.item.image.src">
                        <v-icon v-else>layers</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title v-html="data.item.title"></v-list-item-title>
                        <v-list-item-subtitle><b>ID :</b> {{data.item.id}}, <b>Variants : </b>{{data.item.variants == undefined ? '' : data.item.variants.length}}</v-list-item-subtitle>
                    </v-list-item-content>
                </template>
            </v-combobox>
        </v-flex>

        <v-flex class="xs12 md9">
            <div v-if="product != null && product != undefined">
                <v-chip outlined ripple color="primary" class="mr-2" v-if="product" v-for="(variant, indx) in product.variants"
                        :key="indx" @click="(e) => addVariant(e, variant)">
                    <v-avatar left>
                        <img v-if="variant.image_id != null" :src="ld.find(product.images, {'id': variant.image_id}).src">
                        <v-icon v-else>layers</v-icon>
                    </v-avatar>
                    {{variant.title}}
                </v-chip>
            </div>
        </v-flex>
        <v-flex class="xs12 pt-2 pb-3"><hr /></v-flex>
        <v-flex class="xs12 md3">
            <v-subheader class="pa-0">Selected Variants</v-subheader>
        </v-flex>
        <v-flex class="xs12 md9">
            <v-chip label close color="blue lighten-2" class="productVariantChip selectedVariant mr-2 mb-2" v-for="(variant, indx) in variants"
                    :key="indx" @click:close="(e) => removeVariant(e, variant)">
                <v-avatar left>
                    <img v-if="variant.image != null" :src="variant.image">
                    <img v-else :src="variant.pImage">
                </v-avatar>
                {{variant.title}}
            </v-chip>
        </v-flex>
    </div>
</template>

<script>
    import {api} from '~/config'

    export default {
        props : {
            emitAs : {
                type: String,
                required: true,
            },
            placeholder : {
                type: String,
                required: false,
                default : 'Start typing a product name (at least 3 characters)'
            }
        },
        data () {
           return  {
                bouncer    : _.debounce(this.getProducts, 750),
                options    : [],
                search     : '',
                product    : null,
                lookingUp  : false,
                variants   : [],
                ld         : _,
               selectedVariant : {}
            }
        },
        methods: {
            getProducts(val) {
                let self = this;

                if (self.search == '' || self.search == null || self.search.length <=2 || self.lookingUp) return;

                self.lookingUp = true;
                axios.get(api.path('shopify.findProducts') + self.search).then(function(response){
                    self.lookingUp = false;
                    response.data.forEach(function(prod) {
                        prod.title = prod.title + ' - ' + prod.id;
                    });
                    self.options = response.data;
                });
            },
            addVariant: function(e, variant) {
                let self = this;
                if (self.ld.find(self.variants, {id: variant.id}) != undefined) return true;
                self.selectedVariant = {
                    id          : variant.id,
                    productId   : self.product.id,
                    image       : variant.image_id != null ? self.ld.find(self.product.images, {'id': variant.image_id}).src : null,
                    pImage      : self.product.image.src,
                    title       : self.product.title + ' - ' + variant.title,
                    price       : variant.price
                };
                self.variants = [];
                self.variants.push(self.selectedVariant);

                self.$emit('selected-product', {
                    'item'   : self.selectedVariant,
                    'bindTo' : self.emitAs
                })
            },
            removeVariant: function(e, variant){
                let self = this;
                self.variants.splice( self.ld.findIndex(self.variants, variant), 1 );
            }
        },
        watch: {
            search () {
                let self = this;
                self.tempFunction();
            },
            variants: function() {
                let self = this;
                self.reportedValue = 0;
                self.variants.forEach(function (variant) {
                    self.reportedValue += parseFloat(variant.price);
                });
                self.reportedValue = parseFloat(self.reportedValue).toFixed(2);
            }
        },
        created() {
            let self = this;
            self.tempFunction = _.debounce( this.getProducts, 750);
        }
    }
</script>

<style scoped></style>
