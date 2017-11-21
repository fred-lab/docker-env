/**
 * Created by fred on 17/06/16.
 */

Vue.component ('menu', {
        props: ['category'],

        data: function () {
            return {
                show: this.category.front
            }
        },

        methods: {
            front: function (){
                this.show = this.category.back.split('').reverse().join('');
            },
            back: function () {
                this.show = this.category.front;
            }
        },

        template:`
                <a class="nav-item" href="#"  v-on:mouseover="front"  v-on:mouseout="back">
                    {{ show }}                    
                </a>
                `
    });

new Vue({
    el: 'body',
    data: {
        transitionName: 'flip',
        items: [
            {front: "Dans l'attente...", back: "Les préparatifs"},
            {front: "De se dire Oui!", back: "L'église"},
            {front: "Pour la vie !", back: "La mairie"},
            {front: "Namana", back: "Les groupe"},
            {front: "L & F", back: "Photo du couple"},
            {front: "Au bout de la nuit !", back: "Le repas et la soirée"},
            {front: "#Photomaton", back: "Le Photomaton !"},
        ]
    }
});