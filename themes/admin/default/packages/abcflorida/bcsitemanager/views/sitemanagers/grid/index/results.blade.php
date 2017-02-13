this is a test

<script type="text/template" data-grid="sitemanager" data-template="results">

        

	<% _.each(results, function(r) { %>
		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.sitename %></td>
			<td><%= r.bucketname %></td>
			<td><%= r.isactive %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
