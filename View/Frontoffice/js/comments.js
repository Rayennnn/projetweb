document.addEventListener("DOMContentLoaded", function () {
  const commentsContainer = document.getElementById("commentsContainer")

  function createStars(number, username, job, email, type, comment, id) {
    const starContainer = document.createElement("div")
    starContainer.classList.add("stars")

    for (let i = 1; i <= 5; i++) {
      const star = document.createElement("span")
      star.innerHTML = "★"
      star.dataset.rating = i

      if (number > 0) {
        if (i <= number) {
          star.classList.add("selected")
        }
      } else {
        star.addEventListener("click", function () {
          const siblings = this.parentNode.querySelectorAll("span")
          siblings.forEach((sib) => sib.classList.remove("selected"))
          for (let j = 0; j < i; j++) siblings[j].classList.add("selected")
          const selectedRating = star.getAttribute("data-rating")
          const updateData = {
            id,
            email,
            username,
            stars: +selectedRating,
            job,
            type,
            comment,
          }
          fetch("./update_comment.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(updateData),
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error("Failed to update stars")
              }
              return response.text()
            })
            .then((result) => {})
            .catch((error) => {
              console.error("Error updating stars:", error)
              // Revert star selection if update fails
              siblings.forEach((sib) => sib.classList.remove("selected"))
            })
        })
      }

      starContainer.appendChild(star)
    }

    return starContainer
  }

  function createAnswerElement(answer) {
    const answerElement = document.createElement("div")
    answerElement.classList.add("comment")

    answerElement.innerHTML = `
          <div class="metadata">
            <strong>${answer.username} : ${answer.job}</strong> 
            (${answer.email}) - 
            <span style="text-transform: capitalize;">${answer.type}</span>
          </div>
          <div>${answer.answer}</div>
        `

    return answerElement
  }

  function createCommentElement(comment) {
    const commentElement = document.createElement("div")
    commentElement.classList.add("comment")

    commentElement.innerHTML = `
          <div class="metadata">
            <strong>${comment.username} : ${comment.job}</strong> 
            (${comment.email}) - 
            <span style="text-transform: capitalize;">${comment.type}</span>
          </div>
          <div>${comment.comment}</div>
        `
    commentsContainer.appendChild(commentElement)
    const starRating = createStars(
      comment.stars,
      comment.username,
      comment.job,
      comment.email,
      comment.type,
      comment.comment,
      comment.id
    )

    commentElement.appendChild(starRating)

    const replySection = document.createElement("div")
    replySection.classList.add("reply-section")
    const replyButton = document.createElement("button")
    replyButton.textContent = "Répondre"
    replyButton.addEventListener("click", function () {
      const replyInput = document.createElement("textarea")
      replyInput.placeholder = "Entrez votre réponse ici"

      const replySubmit = document.createElement("button")
      replySubmit.textContent = "Soumettre Réponse"

      replySubmit.addEventListener("click", function () {
        if (!replyInput.value.trim()) {
          alert("Veuillez entrer une réponse valide.")
          return
        }

        const updateData = {
          answer: replyInput.value.trim(),
          comment_id: comment.id,
        }

        fetch("./create_answer.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(updateData),
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("Failed to create")
            }
            return response.text()
          })
          .then((result) => {
            const reply = createAnswerElement({
              username: comment.username,
              email: comment.email,
              job: comment.job,
              type: comment.type,
              answer: replyInput.value.trim(),
              stars: 0,
            })

            replySection.appendChild(reply)
            replyInput.remove()
            replySubmit.remove()
          })
          .catch((error) => {
            console.error("Error creating:", error)
          })
      })

      replySection.appendChild(replyInput)
      replySection.appendChild(replySubmit)
    })
    commentElement.appendChild(replyButton)
    commentElement.appendChild(replySection)

    return commentElement
  }

  fetch("./fetch_all_comments.php")
    .then((response) => response.json())
    .then((comments) => {
      comments.forEach((comment) => {
        const commentElement = createCommentElement(comment)
        const replySection = commentElement.querySelector(".reply-section")
        const answers = comment.answers
        answers.forEach((answer) => {
          const answerElement = createAnswerElement({
            ...answer,
            username: comment.username,
            job: comment.job,
            email: comment.email,
            type: comment.type,
          })
          replySection.appendChild(answerElement)
        })

        commentsContainer.appendChild(commentElement)
      })
    })
    .catch((error) => console.error("Error:", error))

  document
    .getElementById("submitComment")
    .addEventListener("click", function (e) {
      e.preventDefault()
      const username = document.getElementById("username").value.trim()
      const email = document.getElementById("email").value.trim()
      const commentText = document.getElementById("commentText").value.trim()
      const metier = document.getElementById("metier").value.trim()
      const type = document.querySelector('input[name="type"]:checked').value

      if (!username || !email || !commentText || !metier) {
        alert("Veuillez remplir tous les champs avant de soumettre.")
        return
      }

      if (username.length > 20) {
        alert("Le nom d'utilisateur ne doit pas dépasser 20 caractères.")
        return
      }

      if (!validateEmail(email)) {
        alert("Veuillez entrer une adresse email valide contenant '@'.")
        return
      }

      if (countLines(commentText) > 5) {
        alert("Le commentaire ne doit pas dépasser 5 lignes.")
        return
      }

      fetch("./create_comment.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          username,
          email,
          comment: commentText,
          job: metier,
          type,
        }),
      }).catch((error) => {
        console.error("Error:", error)
      })

      const commentElement = createCommentElement({
        username,
        email,
        comment: commentText,
        job: metier,
        type,
      })
      commentsContainer.appendChild(commentElement)
      document.getElementById("username").value = ""
      document.getElementById("email").value = ""
      document.getElementById("commentText").value = ""
      document.getElementById("metier").value = ""
      document.querySelector('input[name="type"][value="idee"]').checked = true
    })

  function validateEmail(email) {
    return email.includes("@")
  }

  function countLines(text) {
    return text.split("\n").length
  }
})
