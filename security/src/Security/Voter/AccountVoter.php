<?php

namespace App\Security\Voter;

use App\Entity\Account;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountVoter extends Voter
{
    public const SHOW = 'SHOW';
    public const DELETE = 'DELETE';

    public function __construct(private readonly Security $security)
    {
    }


    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::SHOW, self::DELETE])
            && $subject instanceof Account;
    }

    /**
     * @param string $attribute
     * @param Account $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        return match ($attribute) {
            self::SHOW => $this->show($subject, $user),
            self::DELETE => $this->security->isGranted('ROLE_ADMIN')
        };
    }

    /**
     * @param Account $subject
     * @param UserInterface $user
     * @return bool
     */
    protected function show(Account $subject, UserInterface $user): bool
    {
        return $subject->getAccountHolder() === $user || $subject->getAccountManager() === $user || $this->security->isGranted('ROLE_ADMIN');
    }
}
