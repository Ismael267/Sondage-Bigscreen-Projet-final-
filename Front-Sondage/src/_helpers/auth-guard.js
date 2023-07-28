import router from '@/router';

// La fonction authGuard accepte un objet "to" en tant que paramètre, représentant l'objet de navigation de la route à laquelle l'utilisateur souhaite accéder.
export function authGuard(to) {
  // Récupération du jeton (token) depuis le stockage local (localStorage).
  let token = localStorage.getItem('token');
  console.log(token); // Affiche le jeton dans la console à des fins de débogage.

  // Si un jeton est présent dans le stockage local, cela signifie que l'utilisateur est authentifié.
  if (token) {
    return true; // Autorise la navigation vers la route demandée.
  }

  // Si aucun jeton n'est trouvé, l'utilisateur n'est pas authentifié et doit être redirigé vers la page de connexion.
  router.push('/login');
}
