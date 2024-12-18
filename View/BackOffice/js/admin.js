document.addEventListener("DOMContentLoaded", function () {
/*  const menuicn = document.querySelector(".menuicn")
*/  const nav = document.querySelector(".navcontainer")

/*  menuicn.addEventListener("click", () => {
    nav.classList.toggle("navclose")
  })*/

  const tableBody = document.querySelector(".report-table tbody")

  function renderStars(stars) {
    const maxStars = 5
    let starsHtml = ""
    for (let i = 1; i <= maxStars; i++) {
      starsHtml += `<span style="color: ${
        i <= stars ? "gold" : "gray"
      }">★</span>`
    }
    return starsHtml
  }

  function truncateText(text, maxLength = 20) {
    return text.length > maxLength ? text.substring(0, maxLength) + "..." : text
  }

  async function fetchComments() {
    try {
      const response = await fetch("./fetch_all_comments.php")
      const comments = await response.json()

      tableBody.innerHTML = ""

      comments.forEach((comment) => {
        const row = document.createElement("tr")
        row.innerHTML = `
                <td class="t-op-nextlvl">${comment.username}</td>
                <td class="t-op-nextlvl">${comment.email}</td>
                <td class="t-op-nextlvl">${
                  truncateText(comment.job) || "N/A"
                }</td>
                <td class="t-op-nextlvl">${comment.type || "General"}</td>
                <td class="t-op-nextlvl">
                    ${truncateText(comment.comment)}
                </td>
                <td class="t-op-nextlvl">${renderStars(comment.stars)}</td>
                <td class="t-op-nextlvl actions">
                    <div class="edit-comment" data-id="${comment.id}">
                        <img src="./img/editt.svg" alt="edit">
                    </div>
                    <div class="delete-comment" data-id="${comment.id}">
                        <img src="./img/delete.svg" alt="delete">
                    </div>
                </td>
            `

        const editBtn = row.querySelector(".edit-comment")
        const deleteBtn = row.querySelector(".delete-comment")

        editBtn.addEventListener("click", () => handleEditComment(comment))
        deleteBtn.addEventListener("click", () =>{
          handleDeleteComment(comment.id)}
        )

        tableBody.appendChild(row)
      })

      const commentsCountElement = document.querySelector(".topic-heading")
      if (commentsCountElement) {
        commentsCountElement.textContent = comments.length
      }
    } catch (error) {
      console.error("Error fetching comments:", error)
      tableBody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; color:red;">
                    Failed to load comments. Please try again later.
                </td>
            </tr>
        `
    }
  }

  function handleEditComment(comment) {
    window.location.href = `./admin-edit-comment.php?id=${comment.id}`;
  }

  async function handleDeleteComment(commentId) {
    try {
      const response = await fetch("./delete_comment.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ comment_id: commentId }),
      })
      
      const result = await response.json()
      
      if (result.status=='success') {
        fetchComments()
      } else {
        alert("Failed to delete comment")
      }
    } catch (error) {
      console.error("Delete error:", error)
      alert("An error occurred while deleting the comment")
    }
  }

  const deleteAllComments = document.getElementById('deleteAllComments');
deleteAllComments.addEventListener('click',async ()=>{

  try {
        const confirmDelete = confirm("Are you sure you want to delete all messages? This action cannot be undone.");
    
    if (confirmDelete) {
      await fetch("./delete_all_comments.php", {
        method: "POST",
      });
      fetchComments(); 
      alert("All messages have been deleted successfully.");
    }
  } catch (error) {
    console.error("Delete error:", error);
    alert("An error occurred while deleting the comments");
  }
})

  fetchComments()
})
