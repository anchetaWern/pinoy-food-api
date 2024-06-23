<script type="text/x-handlebars-template" id="food-states-template">
    <option value="">--Select Food State--</option>
    {{#each food_states}}
    <option value="{{id}}">{{name}}</option>
    {{/each}}
</script>