<script type="text/x-handlebars-template" id="nutrients-preview-template">
    <ul>
        <li>Calories: {{calories}}</li>
        <li>Serving size: {{serving_size}}</li>
        <li>Servings per container: {{servings_per_container}}</li>
    </ul>

    <table class="table table-sm" id="small-table">
        <thead>
            <tr>
                <th>Nutrient</th>
                <th>Amount</th>
            </tr>
        </thead>
        
        <tbody>
            {{#each nutrients as | root_nutrients |}}
            <tr>
                <td>{{root_nutrients.name}}</td>
                <td>{{root_nutrients.value}}</td>
            </tr>
            {{#if root_nutrients.child}}
                {{#each root_nutrients.child as | parent_nutrients |}}
                <tr>
                    <td colspan="2">
                        <table class="table table-sm nested-level-1 mb-0">
                            <tbody>
                                <tr>
                                    <td>{{parent_nutrients.name}}</td>
                                    <td>{{parent_nutrients.value}}</td>
                                </tr>

                                {{#if parent_nutrients.child}}
                                    {{#each parent_nutrients.child as | child_nutrients |}}
                                    <tr>
                                        <td colspan="2">

                                            <table class="table table-sm nested-level-1 mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{child_nutrients.name}}</td>
                                                        <td>{{child_nutrients.value}}</td>
                                                    </tr>
                                                </tbody>
                        
                                            </table>

                                        </td>
                                    </tr>
                                    {{/each}}
                                {{/if}}
                            </tbody>
                        </table>
                    </td>
                </tr>
                {{/each}}
            {{/if}}
            {{/each}}
        </tbody>
    </table>
</script>