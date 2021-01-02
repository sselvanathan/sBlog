function deleteBlogPostById(id) {
    fetch('/deleteBlog?id=' + id, {
            'method': 'DELETE',
            'body': id,
        }
    ).then(response => {
        response.ok;
    })
    document.getElementById(id).style.display = 'none';
}