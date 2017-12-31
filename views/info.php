<?php

?>

<div id="sixshooter">
  <button v-on:click="pullTrigger"> Hope for the Best </button>
  <p> {{ result  }} </p>
</div>

<script>
new Vue({
  el: '#sixshooter',

  data: {
    result: ''
  },

  methods: {
    pullTrigger: function(){
        var bulletPosition = this.randomSixShooterPosition;
        var triggerChamber = this.randomSixShooterPosition;
        if ( bulletPosition() == triggerChamber() )
            this.result = 'BOM! Nigga you dead!';
        else
            this.result = 'click..';
    },
    randomSixShooterPosition: function(){
        return Math.floor((Math.random() * 6) + 1);
    }
  }
})
</script>
