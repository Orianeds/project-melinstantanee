'use client';

import { Suspense, useState } from 'react';
import { useSearchParams, useRouter } from 'next/navigation';

function PasswordChangeForm() {
  const searchParams = useSearchParams();
  const token = searchParams.get('token');

  const router = useRouter();

  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const submit = async (e: React.FormEvent) => {
    e.preventDefault();

    const res = await fetch('http://localhost:8000/api/password/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        token,
        password,
      }),
    });

    if (res.ok) {
      router.push('/');
    } else {
      const data = await res.json();
      setError(data.error);
    }
  };

  return (
    <form onSubmit={submit}>
      <h1>Créer votre mot de passe</h1>

      <input
        type="password"
        required
        value={password}
        onChange={(e) => setPassword(e.target.value)}
      />

      {error && <p>{error}</p>}

      <button type="submit">
        Valider
      </button>
    </form>
  );
}

export default function PasswordChangePage() {
  return (
    <Suspense fallback={<p>Chargement...</p>}>
      <PasswordChangeForm />
    </Suspense>
  );
}