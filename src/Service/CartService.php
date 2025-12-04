<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Service de gestion du panier d'achat en session.
 * Permet aux utilisateurs (connectés ou non) de gérer leur panier.
 */
class CartService
{
    private const CART_SESSION_KEY = 'cart';

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    /**
     * Récupère le panier depuis la session.
     * @return array<int, array{id: string, titre: string, duree: string, prix: float, quantite: int}>
     */
    public function getCart(): array
    {
        return $this->requestStack->getSession()->get(self::CART_SESSION_KEY, []);
    }

    /**
     * Ajoute un item au panier ou incrémente la quantité si déjà présent.
     */
    public function addItem(string $id, string $titre, string $duree, float $prix): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantite']++;
        } else {
            $cart[$id] = [
                'id' => $id,
                'titre' => $titre,
                'duree' => $duree,
                'prix' => $prix,
                'quantite' => 1,
            ];
        }

        $this->saveCart($cart);
    }

    /**
     * Retire un item du panier.
     */
    public function removeItem(string $id): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }
    }

    /**
     * Décrémente la quantité d'un item ou le supprime si quantité = 0.
     */
    public function decrementItem(string $id): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantite']--;
            
            if ($cart[$id]['quantite'] <= 0) {
                unset($cart[$id]);
            }
            
            $this->saveCart($cart);
        }
    }

    /**
     * Incrémente la quantité d'un item existant.
     */
    public function incrementItem(string $id): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantite']++;
            $this->saveCart($cart);
        }
    }

    /**
     * Vide entièrement le panier.
     */
    public function clearCart(): void
    {
        $this->requestStack->getSession()->remove(self::CART_SESSION_KEY);
    }

    /**
     * Calcule le total du panier.
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return $total;
    }

    /**
     * Retourne le nombre total d'articles dans le panier.
     */
    public function getItemCount(): int
    {
        $count = 0;
        foreach ($this->getCart() as $item) {
            $count += $item['quantite'];
        }
        return $count;
    }

    /**
     * Sauvegarde le panier en session.
     */
    private function saveCart(array $cart): void
    {
        $this->requestStack->getSession()->set(self::CART_SESSION_KEY, $cart);
    }
}
