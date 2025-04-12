"use client"
import Link from 'next/link'
import React, {useState, useEffect} from 'react'
import Image from 'next/image';
import {AiOutlineMenu, AiOutlineClose} from 'react-icons/ai';
import { usePathname, useRouter } from 'next/navigation';

const Navbar = () => {
  const router = useRouter();
  const pathname = usePathname();
  
  const [nav, setNav] = useState(false)
  const [color, setColor] = useState('transparent')

  const handleNav = () => {
    setNav(!nav)
  }

  useEffect(() => {
    const changeColor = () => {
      
      if (pathname === '/') {
        if(window.scrollY >= 90){
          setColor('#d3b8a5')
        } else {
          setColor('transparent')
        }
      } else{
        setColor('#d3b8a5')
      }
    };

    window.addEventListener('scroll', changeColor);

    return () =>{
      window.removeEventListener('scroll', changeColor);
    };
  }, [pathname]);
  


  return (
    <div style={{backgroundColor: `${color}`}} className='fixed left-0 top-0 w-full z-10 ease-in duration-300 textInter'>
        <div className='max-w-[1240px] m-auto flex justify-between items-center p-4 text-white'>
            <Link href='/'>
            <h1 style={{color: '#ffffff'}} className='font-bold text-3xl'>Mel'instantanée</h1>
            </Link>
            <ul style={{color: '#ffffff'}} className='hidden sm:flex'>
                <li className='p-4'>
                  <Link href='/'>Accueil</Link>
                </li>
                <li className='p-4'>
                  <Link href='/portfolio'>Portfolio</Link>
                </li>
                <li className='p-4'>
                  <Link href='/tarifs'>Tarifs</Link>
                </li>
                <li className='p-4'>
                  <Link href='/contact'>Contact</Link>
                </li>
                <li className='p-4'>
                  <Link href='/connexion'>Connexion</Link>
                </li>
                <li className='p-4'>
                  <Link href='https://www.instagram.com/melissa_daigre/' target='_blank'><Image src='/instagram.png' width={40} height={40} alt="logo instagram" /></Link>
                </li>
            </ul>


            {/* Mobile Button */}
            <div onClick={handleNav} className='block sm:hidden z-10'>
              {nav ? <AiOutlineClose size={20} style={{color: '#ffffff'}} /> : <AiOutlineMenu size={20} style={{color: '#ffffff'}} />}
            </div>
            {/* Mobile Menu */}
            <div className={
              nav ? 'sm:hidden absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center w-full h-screen bg-brown text-center ease-in duration-300'
              : 'sm:hidden absolute top-0 left-[-100%] right-0 bottom-0 flex justify-center items-center w-full h-screen bg-brown text-center ease-in duration-300'
            }>
              <ul>
                  <li className='p-4 text-4xl hover:text-gray-500'>
                    <Link href='/'>Accueil</Link>
                  </li>
                  <li className='p-4 text-4xl hover:text-gray-500'>
                    <Link href='/portfolio'>Portfolio</Link>
                  </li>
                  <li className='p-4 text-4xl hover:text-gray-500'>
                    <Link href='/tarifs'>Tarifs</Link>
                  </li>
                  <li className='p-4 text-4xl hover:text-gray-500'>
                    <Link href='/contact'>Contact</Link>
                  </li>
                  <li className='p-4 text-4xl hover:text-gray-500'>
                    <Link href='/login'>Connexion</Link>
                  </li>
                  <li className='p-4 pl-20 text-4xl hover:text-gray-500 '>
                  <Link href='https://instagram.com' target='_blank'><Image src='/instagram.png' width={40} height={40} alt="logo instagram" /></Link>
                </li>
              </ul>
            </div>
        </div>
    </div>
  )
}

export default Navbar