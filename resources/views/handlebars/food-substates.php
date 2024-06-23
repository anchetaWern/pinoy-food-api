<script type="text/x-handlebars-template" id="food-substates-template">
    <option value="">--Select Food Substate--</option>
    {{#each food_substates}}
    <option value="{{id}}">{{name}}</option>
    {{/each}}
</script>