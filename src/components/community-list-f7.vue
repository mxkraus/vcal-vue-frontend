<template>
    <div class="communities">

        <f7-input
            id="search"
            v-model="search"
            type="text"
            @input="search = $event.target.value"
            placeholder="Verein suchen"
            clear-button
        ></f7-input>

        <f7-list accordion-list>
            <f7-list-item 
                accordion-item 
                :title="community.verein_full" 
                :badge="getObjectSize( community.termine )"
                class="community" 
                v-for="community in filteredComunity" 
                :key="community.id">

                <f7-accordion-content>
                    <f7-block>
                        <f7-card
                            :title="termin.timefrom"
                            :content="termin.title "
                            v-for="termin in community.termine"
                            :key="termin.id"
                        ></f7-card>
                    </f7-block>
                </f7-accordion-content>

            </f7-list-item>
        </f7-list>

        

    </div>
</template>

<script>

import { f7Input, f7List, f7ListItem, f7AccordionContent, f7Block, f7Card} from 'framework7-vue';

    export default{
        name: 'Events',
        components: {
            f7Input,
            f7List,
            f7ListItem,
            f7AccordionContent,
            f7Block,
            f7Card
        },
        data(){
            return{
                communities: [],
                search: '',
                selected: '',
                isCollapsed: false,
                yearNow: new Date().getFullYear(),
                yearNext: new Date().getFullYear() + 1,
                
            }
        },
        methods:{
            expandChild: function(){
                this.isCollapsed = true;
            },
            mix: function( a ) {
                for (let i = a.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [a[i], a[j]] = [a[j], a[i]];
                }
                return a;
            },
            getObjectSize: function( obj ){
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            }
        },
        created: function(){
            this.$http.get('https://mxkraus.de/Vereinskalender/get-vcal-events.php?year=2020').then( response => {
                this.communities = this.mix( response.body );
            }, response => {
                console.log(response.error);
            });
        },
        mounted: function(){

        },
        computed: {
            filteredComunity: function(){
                return this.communities.filter( community => {
                    //return community.verein.toLowerCase().match(this.search) || community.verein.match(this.search);
                    return community.verein.toLowerCase().includes(this.search.toLowerCase())
                });
            }, 
        }
    }
</script>

<style lang="scss" scoped>

    #search, #chooseYear{
        padding: 15px;
        background-color: #f8f8f8;
    }
    .list{
        margin: 0;
    }
    .communities{
        height: 100%;
        width: 100%;
        font-size: 16px;
        .community{
            width: 100%;
            cursor: pointer;

            .accordion-item-content .block{
                padding: 15px;
            }
        }
        
    }

</style>
