<script type="text/x-handlebars-template" id="food-subtypes-template">
    <option value="">--Select Food Subtype--</option>
    {{#each food_subtypes}}
    <option value="{{id}}">{{name}}</option>
    {{/each}}
</script>