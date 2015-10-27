$(function() {
  $('#deleteBtn').click(function(e) {
    e.preventDefault();
    if (confirm('Delete this property?')) {
      window.href = '/wallfly-mvc/public/propertycontrol/delete';
    }
  });
});