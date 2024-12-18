document.addEventListener("DOMContentLoaded", function () {
/*  const menuicn = document.querySelector(".menuicn")
*/  const nav = document.querySelector(".navcontainer")
  const commentsLink = document.querySelector(".comments-link")
  console.log(commentsLink)
  commentsLink.addEventListener("click", () => {
    window.location.href = `./admin-comments.php`
  })
/*  menuicn.addEventListener("click", () => {
    nav.classList.toggle("navclose")
  })*/
  const form = document.getElementById("edit-comment-form")
  const errorContainer = document.getElementById("error-container")

  function getCommentIdFromURL() {
    const urlParams = new URLSearchParams(window.location.search)
    return urlParams.get("id")
  }

  async function fetchCommentDetails(commentId) {
    try {
      const response = await fetch(
        `./get_commentByid.php?id=${commentId}`
      )
      if (!response.ok) {
        throw new Error("Failed to fetch comment details")
      }

      const commentData = await response.json()
      const { comment } = commentData

      document.getElementById("comment_id").value = comment.id
      document.getElementById("username").value = comment.username
      document.getElementById("email").value = comment.email
      document.getElementById("job").value = comment.job || ""
      document.getElementById("type").value = comment.type || ""
      document.getElementById("comment").value = comment.comment
      document.getElementById("stars").value = comment.stars
    } catch (error) {
      errorContainer.textContent = error.message
      console.error("Error:", error)
    }
  }

  async function updateComment(formData) {
    try {
      await fetch("./update_comment.php", {
        method: "POST",
        body: JSON.stringify(formData),
      })

      window.location.href = `./admin-edit-comment.php?id=${commentId}`
    } catch (error) {
      errorContainer.textContent = "An error occurred. Please try again."
      console.error("Error:", error)
    }
  }

  form.addEventListener("submit", async function (e) {
    e.preventDefault()

    errorContainer.textContent = ""
    const id = getCommentIdFromURL()
    const username = document.getElementById("username").value
    const email = document.getElementById("email").value
    const job = document.getElementById("job").value
    const type = document.getElementById("type").value
    const comment = document.getElementById("comment").value
    const stars = document.getElementById("stars").value

    await updateComment({ id, username, email, job, type, comment, stars })
  })

  const commentId = getCommentIdFromURL()

  if (commentId) {
    fetchCommentDetails(commentId)
  } else {
    errorContainer.textContent = "No comment ID provided"
  }
})
