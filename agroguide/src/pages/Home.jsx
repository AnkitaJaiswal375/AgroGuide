import React, { useState, useEffect } from 'react';
import { Search, Cloud, TrendingUp, BookOpen, Users, Calendar, Phone, Mail, MapPin, ChevronRight, Leaf, Sprout, Heart } from 'lucide-react';
import './Home.css';

const Home = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [currentSlide, setCurrentSlide] = useState(0);

  const featuredCrops = [
    { id: 1, name: 'Wheat', nameHi: 'गेहूं', season: 'Rabi', image: '🌾', duration: '120-150 days' },
    { id: 2, name: 'Rice', nameHi: 'चावल', season: 'Kharif', image: '🌾', duration: '90-120 days' },
    { id: 3, name: 'Tomato', nameHi: 'टमाटर', season: 'All Season', image: '🍅', duration: '60-80 days' },
    { id: 4, name: 'Potato', nameHi: 'आलू', season: 'Rabi', image: '🥔', duration: '90-120 days' },
    { id: 5, name: 'Cotton', nameHi: 'कपास', season: 'Kharif', image: '☁️', duration: '150-180 days' },
    { id: 6, name: 'Sugarcane', nameHi: 'गन्ना', season: 'All Season', image: '🎋', duration: '12-18 months' },
  ];

  const popularCrops = [
    { id: 1, name: 'Wheat', nameHi: 'गेहूं', category: 'Cereal', image: '🌾' },
    { id: 2, name: 'Rice', nameHi: 'चावल', category: 'Cereal', image: '🌾' },
    { id: 3, name: 'Corn', nameHi: 'मक्का', category: 'Cereal', image: '🌽' },
    { id: 4, name: 'Tomato', nameHi: 'टमाटर', category: 'Vegetable', image: '🍅' },
    { id: 5, name: 'Onion', nameHi: 'प्याज', category: 'Vegetable', image: '🧅' },
    { id: 6, name: 'Potato', nameHi: 'आलू', category: 'Vegetable', image: '🥔' },
  ];

  const blogPosts = [
    {
      id: 1,
      title: 'Modern Irrigation Techniques for Better Yield',
      excerpt: 'Learn about drip irrigation and sprinkler systems...',
      date: '2 days ago',
      category: 'Technology'
    },
    {
      id: 2,
      title: 'Organic Farming: A Sustainable Approach',
      excerpt: 'Discover the benefits of chemical-free farming...',
      date: '5 days ago',
      category: 'Organic'
    },
    {
      id: 3,
      title: 'Government Schemes for Farmers 2025',
      excerpt: 'Complete guide to PM-KISAN and other schemes...',
      date: '1 week ago',
      category: 'Schemes'
    },
  ];

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % featuredCrops.length);
    }, 3000);
    return () => clearInterval(timer);
  }, []);

  const handleSearch = () => {
    console.log('Searching for:', searchQuery);
  };

  const handleKeyPress = (e) => {
    if (e.key === 'Enter') {
      handleSearch();
    }
  };

  return (
    <div className="home-container">
      {/* Header */}
      <header className="header">
        <div className="header-content">
          <div className="logo">
            <Leaf size={32} />
            <h1>AgroGuide</h1>
          </div>
          <nav className="nav">
            <a href="/">Home</a>
            <a href="/crops">Crops</a>
            <a href="/blog">Blog</a>
            <a href="/schemes">Schemes</a>
            <a href="/market">Market</a>
            <a href="/contact">Contact</a>
          </nav>
          <div className="auth-buttons">
            <button className="btn-login">Login</button>
            <button className="btn-register">Register</button>
          </div>
        </div>
      </header>

      {/* Hero Section */}
      <section className="hero">
        <div className="container">
          <h2>Welcome to AgroGuide</h2>
          <p>Your Complete Agricultural Companion | आपका कृषि साथी</p>
          
          <div className="search-container">
            <div className="search-box">
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                onKeyPress={handleKeyPress}
                placeholder="Search for crops, diseases, tips... (फसल, रोग, सुझाव खोजें...)"
                className="search-input"
              />
              <button onClick={handleSearch} className="search-button">
                <Search size={24} />
              </button>
            </div>
          </div>

          <div className="stats-grid">
            <div className="stat-card">
              <div className="stat-number">100+</div>
              <div className="stat-label">Crops</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">500+</div>
              <div className="stat-label">Articles</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">10K+</div>
              <div className="stat-label">Farmers</div>
            </div>
            <div className="stat-card">
              <div className="stat-number">24/7</div>
              <div className="stat-label">Support</div>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Crop Slider */}
      <section className="section section-white">
        <div className="container">
          <h2 className="section-title">Featured Crops | विशेष फसलें</h2>
          <div className="slider-container">
            <div className="slide-content">
              <div className="slide-emoji">{featuredCrops[currentSlide].image}</div>
              <h3 className="slide-title">
                {featuredCrops[currentSlide].name} ({featuredCrops[currentSlide].nameHi})
              </h3>
              <div className="slide-tags">
                <span className="tag tag-green">{featuredCrops[currentSlide].season}</span>
                <span className="tag tag-blue">{featuredCrops[currentSlide].duration}</span>
              </div>
              <button className="btn-learn-more">Learn More</button>
            </div>
            <div className="slide-indicators">
              {featuredCrops.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentSlide(index)}
                  className={`indicator ${index === currentSlide ? 'indicator-active' : ''}`}
                />
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Quick Features */}
      <section className="section section-gray">
        <div className="container">
          <h2 className="section-title">Our Features | हमारी सुविधाएं</h2>
          <div className="features-grid">
            <div className="feature-card">
              <Cloud className="feature-icon icon-blue" size={48} />
              <h3>Weather Updates</h3>
              <p>Real-time weather forecasts for your location</p>
              <a href="/weather" className="feature-link">
                Check Weather <ChevronRight size={16} />
              </a>
            </div>

            <div className="feature-card">
              <TrendingUp className="feature-icon icon-green" size={48} />
              <h3>Market Prices</h3>
              <p>Latest mandi prices across India</p>
              <a href="/market" className="feature-link">
                View Prices <ChevronRight size={16} />
              </a>
            </div>

            <div className="feature-card">
              <BookOpen className="feature-icon icon-orange" size={48} />
              <h3>Government Schemes</h3>
              <p>All farming schemes and subsidies</p>
              <a href="/schemes" className="feature-link">
                Explore Schemes <ChevronRight size={16} />
              </a>
            </div>

            <div className="feature-card">
              <Users className="feature-icon icon-purple" size={48} />
              <h3>Q&A Community</h3>
              <p>Ask questions, get expert answers</p>
              <a href="/questions" className="feature-link">
                Ask Question <ChevronRight size={16} />
              </a>
            </div>

            <div className="feature-card">
              <Calendar className="feature-icon icon-red" size={48} />
              <h3>Crop Calendar</h3>
              <p>Know what to plant and when</p>
              <a href="/calendar" className="feature-link">
                View Calendar <ChevronRight size={16} />
              </a>
            </div>

            <div className="feature-card">
              <Sprout className="feature-icon icon-teal" size={48} />
              <h3>Pest Management</h3>
              <p>Identify and treat crop diseases</p>
              <a href="/diseases" className="feature-link">
                Learn More <ChevronRight size={16} />
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* Popular Crops */}
      <section className="section section-white">
        <div className="container">
          <div className="section-header">
            <h2>Popular Crops | लोकप्रिय फसलें</h2>
            <a href="/crops" className="view-all-link">
              View All <ChevronRight size={20} />
            </a>
          </div>
          <div className="crops-grid">
            {popularCrops.map((crop) => (
              <div key={crop.id} className="crop-card">
                <div className="crop-emoji">{crop.image}</div>
                <h3>{crop.name}</h3>
                <p>{crop.nameHi}</p>
                <span className="crop-category">{crop.category}</span>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Latest Blog Posts */}
      <section className="section section-gray">
        <div className="container">
          <div className="section-header">
            <h2>Latest Articles | नवीनतम लेख</h2>
            <a href="/blog" className="view-all-link">
              View All <ChevronRight size={20} />
            </a>
          </div>
          <div className="blog-grid">
            {blogPosts.map((post) => (
              <div key={post.id} className="blog-card">
                <div className="blog-image"></div>
                <div className="blog-content">
                  <span className="blog-category">{post.category}</span>
                  <h3>{post.title}</h3>
                  <p className="blog-excerpt">{post.excerpt}</p>
                  <div className="blog-footer">
                    <span className="blog-date">{post.date}</span>
                    <a href={`/blog/${post.id}`} className="blog-link">
                      Read More →
                    </a>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="cta-section">
        <div className="container">
          <h2>Join Thousands of Farmers</h2>
          <p>Get expert advice, market updates, and more!</p>
          <div className="cta-buttons">
            <button className="btn-cta-primary">Register Now</button>
            <button className="btn-cta-secondary">Learn More</button>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="footer">
        <div className="footer-content">
          <div className="footer-grid">
            <div>
              <div className="footer-logo">
                <Leaf size={24} />
                <h3>AgroGuide</h3>
              </div>
              <p className="footer-description">Your trusted agricultural companion for better farming.</p>
            </div>
            <div>
              <h4>Quick Links</h4>
              <ul>
                <li><a href="/crops">Crops</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/schemes">Schemes</a></li>
                <li><a href="/market">Market Prices</a></li>
              </ul>
            </div>
            <div>
              <h4>Support</h4>
              <ul>
                <li><a href="/faq">FAQ</a></li>
                <li><a href="/contact">Contact Us</a></li>
                <li><a href="/privacy">Privacy Policy</a></li>
                <li><a href="/terms">Terms of Service</a></li>
              </ul>
            </div>
          </div>
          <div className="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 AgroGuide. All rights reserved. Made with <Heart className="w-4 h-4 inline text-red-500" /> for Indian Farmers</p>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default Home;             